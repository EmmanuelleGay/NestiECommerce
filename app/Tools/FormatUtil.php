<?php

namespace App\Tools;


/**
 * Util
 * Format-related convenience methods.
 */
class FormatUtil
{

    const TRANSLATIONS = [
        "default"=>[
        ],
        "Users"=>[
            "administrator"=>"Administrateur",
            "moderator"=>"Modérateur",
            "chef"=>"Chef",
            "a"=>"Actif",
            "b"=>"Bloqué",
            "w"=>"En attente",
        ],
        "Orders"=>[
            "a"=>"Payée",
            "b"=>"Annulée",
            "w"=>"En attente",
        ],
        "Comment"=>[
            "a"=>"Approuvé",
            "b"=>"Bloqué",
            "w"=>"En attente",
        ],
        "Tag"=>[
            'easy' => 'Facile',
            'seasonnal' => 'De saison',
            'traditional' => 'Traditionnelle',
            'glutenFree' => 'Sans gluten',
        ]
    ];

    /**
     * dump
     * generates an html representation of a variable
     * 
     * @param  mixed $var to display in html
     * @return void
     */
    public static function dump($var)
    {
        echo "<pre>" . htmlentities(print_r($var, true)) . "</pre>";
    }

        
    /**
     * translate
     *
     * @param  mixed $english
     * @param  mixed $dataset
     */
    public static function translate($english, $dataset="default")
    {
        return static::TRANSLATIONS[$dataset][$english];
       
    }
    
    
    /**
     * combineRules
     *
     * @param  mixed $rules1
     * @param  mixed $rules2
     * @return array
     */
    public static function combineRules($rules1, $rules2): array {
        $validation =  \Config\Services::validation();
		return array_merge($validation->getRuleGroup($rules1),$validation->getRuleGroup($rules2));
	}
}
