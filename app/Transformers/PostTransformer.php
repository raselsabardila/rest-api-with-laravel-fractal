<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use \App\User;
use \App\Post;

class PostTransformer extends TransformerAbstract{

    public function transform(Post $post){
        return [
            "id" => $post->id,
            "content" => $post->content,
            "published" => $post->created_at->format("d M Y")
        ];
    }

}