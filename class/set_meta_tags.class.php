<?php

class set_meta_tags {

    var $seo_array = array(
        'title' => '',
        'description' => '',
        'keywords' => '',
        'index_allow' => 'false'
    );

    /**
     * @param bool $add_metas
     */
    function set_meta_tags_index($add_metas = false) {

        if ($add_metas === true) {

            if (is_array($this->seo_array) && array_key_exists('title', $this->seo_array)) {

                if (strlen($this->seo_array['title'])) {

                    echo '<title>' . trim($this->seo_array['title']) . '</title>' . "\n";
                }
            }

            if (is_array($this->seo_array) && array_key_exists('description', $this->seo_array)) {

                if (strlen($this->seo_array['description'])) {

                    echo '<meta name="description" content="' . trim($this->seo_array['description']) . '">' . "\n";
                }
            }

            if (is_array($this->seo_array) && array_key_exists('keywords', $this->seo_array)) {

                if (strlen($this->seo_array['keywords'])) {

                    echo '<meta name="keywords" content="' . trim($this->seo_array['keywords']) . '">' . "\n";
                }
            }

            if (is_array($this->seo_array) && array_key_exists('index_allow', $this->seo_array)) {

                if ($this->seo_array['index_allow'] === true) {

                    echo '<meta name="robots" content="index, nofollow, noarchive">' . "\n";
                    echo '<meta name="googlebot" content="index">' . "\n";
                    echo '<meta name="googlebot" content="nofollow">' . "\n";
                    echo '<meta name="googlebot" content="nofarchive">' . "\n";
                } else {

                    echo '<meta name="robots" content="noindex, nofollow, noarchive">' . "\n";
                    echo '<meta name="googlebot" content="noindex">' . "\n";
                    echo '<meta name="googlebot" content="nofollow">' . "\n";
                    echo '<meta name="googlebot" content="nofarchive">' . "\n";
                }
            }
        } else {

            echo '<meta name="robots" content="noindex, nofollow, nofarchive">' . "\n";
            echo '<meta name="googlebot" content="noindex">' . "\n";
            echo '<meta name="googlebot" content="nofollow">' . "\n";
            echo '<meta name="googlebot" content="nofarchive">' . "\n";
        }
    }

}
