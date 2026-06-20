<?php

return [
    'required'  => ':attributeは必須です。',
    'email'     => ':attributeは有効なメールアドレスで入力してください。',
    'min'       => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max'       => [
        'string' => ':attributeは:max文字以下で入力してください。',
    ],
    'confirmed' => ':attributeが一致しません。',
    'unique'    => ':attributeはすでに使用されています。',
    'current_password' => '現在のパスワードが正しくありません。',

    'attributes' => [
        'name'                  => 'ユーザー名',
        'email'                 => 'メールアドレス',
        'password'              => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
        'current_password'      => '現在のパスワード',
    ],
];