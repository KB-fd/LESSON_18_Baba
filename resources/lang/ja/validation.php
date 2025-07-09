<?php

return [
    'required' => ':attribute は必須です。',
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'custom' => [
        'content' => [
            'regex' => '全角スペースのみの投稿はできません。',
        ],
    ],
    'attributes' => [
        'content' => '投稿内容',
    ],
    'regex' => ':attribute の形式が正しくありません。',

];
