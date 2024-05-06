<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class FillingDatabase extends Command
{

    protected $signature = 'app:filling-database';


    protected $description = 'Команда для предзаполнения БД';


    private Client $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->syncPosts();
        $this->syncComments();
    }


    /**
     * @throws GuzzleException
     */
    private function syncComments(): void
    {
        $this->info('Выгрузка комментариев...');

        $comments = $this->getComments();

        $progressBar = $this->output->createProgressBar(count($comments));

        foreach ($comments as $comment) {
            Comment::query()->firstOrCreate([
                'id' => $comment->id,
            ], [
                'post_id' => $comment->postId,
                'name' => $comment->name,
                'email' => $comment->email,
                'body' => $comment->body,
            ]);
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->info("\nВыгрузка комментариев завершена");
    }


    /**
     * @throws GuzzleException
     */
    private function syncPosts(): void
    {
        $this->info('Выгрузка постов...');

        $posts = $this->getPosts();

        $progressBar = $this->output->createProgressBar(count($posts));

        foreach ($posts as $post) {
            Post::query()->firstOrCreate([
                'id' => $post->id
            ], [
                'user_id' => $post->userId,
                'title' => $post->title,
                'body' => $post->body,
            ]);
            $progressBar->advance();
        }
        $progressBar->finish();

        $this->info("\nВыгрузка постов завершена");
    }


    /**
     * @throws GuzzleException
     */
    private function getPosts()
    {
        $posts = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts');

        return json_decode($posts->getBody());
    }

    /**
     * @throws GuzzleException
     */
    private function getComments()
    {
        $posts = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/comments');

        return json_decode($posts->getBody());
    }
}
