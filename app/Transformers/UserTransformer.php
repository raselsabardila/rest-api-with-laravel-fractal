<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Transformers\PostTransformer;
use \App\User;

class UserTransformer extends TransformerAbstract{
    
    protected $availableIncludes=[
        "posts"
    ];

    public function transform(User $user){

        return [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "registered" => $user->created_at->format("d M Y")
        ];
    }

    public function includePosts(User $user){
        $post = $user->post;

        return $this->collection($post, new PostTransformer);
    }

}