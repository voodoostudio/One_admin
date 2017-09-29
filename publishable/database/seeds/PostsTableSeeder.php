<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $post = $this->findPost('my-sample-post');
        if (!$post->exists) {
            $post->fill([
                'title'             => 'My Sample Post',
                'exclusiveness'     => 1,
                'author_id'         => 0,
                'seo_title'         => null,
                'excerpt'           => 'This is the excerpt for the sample Post',
                'body'              => '<p>This is the body for the sample post, which includes the body.</p>
                <h2>We can use all kinds of format!</h2>
                <p>And include a bunch of other stuff.</p>',
                'image'             => 'posts/post2.jpg',
                'slug'              => 'my-sample-post',
                'meta_description'  => 'Meta Description for sample post',
                'meta_keywords'     => 'keyword1, keyword2, keyword3',
                'reference'         => 'Some reference',
                'note_transaction'  => 'Nice transaction',
                'broker_notes'      => 'All right',
                'important_notes'   => 'Very good',
                'owner_notes'       => 'All right',
                'mandate_start'     => '2017-09-25 08:00:00',
                'term_end'          => '2017-10-20 18:00:00',
                'availability'      => '2017-10-15 18:00:00',
                'availab_from'      => '2017-09-28 18:00:00',
                'availab_until'     => '2017-10-25 18:00:00',
                'status'            => 'PUBLISHED',
                'featured'          => 0,
            ])->save();
        }
    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findPost($slug)
    {
        return Post::firstOrNew(['slug' => $slug]);
    }
}
