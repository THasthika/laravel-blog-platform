<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Reaction;
use App\Models\Category;
use App\Models\Tag;
use \App\Models\User;

return new class extends Migration {
    private $TAGS = [
        "python", "javascript", "php", "c++", "c#", "java", "machine learning", "artificial intelligence"
    ];

    private $CATEGORIES = [
        "Programming", "Computer Science", "Game Development", "Mathematics"
    ];

    private $REACTIONS = [
        [
            "name" => "Like",
            "icon_path" => "/reactions/like.png"
        ],
        [
            "name" => "Clap",
            "icon_path" => "/reactions/clap.png"
        ],
        [
            "name" => "Award",
            "icon_path" => "/reactions/award.png"
        ]
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // setup admin user
        $admin = new User([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@test.com',
        ]);

        $admin->makeAdmin();
        $admin->markEmailAsVerified();
        $admin->save();

        // add tags
        $tag_insert = [];
        foreach ($this->TAGS as $tag_name) {
            $tag_insert[] = [
                'id' => Str::uuid(),
                'name' => $tag_name,
            ];
        }
        Tag::insert($tag_insert);

        // add categories
        $cat_insert = [];
        foreach ($this->CATEGORIES as $cat_name) {
            $cat_insert[] = [
                'id' => Str::uuid(),
                'name' => $cat_name,
            ];
        }
        Category::insert($cat_insert);

        // add reactions
        $reaction_insert = [];
        foreach ($this->REACTIONS as $reaction) {
            $reaction_insert[] = [
                'id' => Str::uuid(),
                'name' => $reaction['name'],
                'icon_path' => $reaction['icon_path']
            ];
        }
        Reaction::insert($reaction_insert);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // admin user
        User::where('username', 'admin')->delete();

        // remove tags
        Tag::delete();

        // remove categories
        Category::delete();

        // remove reactions
        Reaction::delete();
    }
};
