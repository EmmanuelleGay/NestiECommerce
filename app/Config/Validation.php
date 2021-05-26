<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];


	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $userRules = [
		'lastName'  => "required|max_length[150]",
		'firstName' => "required|max_length[150]",
		'address1'  => "required|max_length[150]",
		'address2'  => 'max_length[150]',
		'city'      => "required|max_length[50]",

		'zipCode'   => [
			"rules" => "required|max_length[5]|numeric",
			"errors" => [
				"numeric" => "Le code postal est incorrect, veuillez vérifier votre saisie"
			]
		],
	];

	public $userRulesSignUp = [
		"email" => [
			"rules" => 'required|valid_email',
			"errors" => [
				"is_unique" => "Un compte utilisateur ayant cette adresse email existe déjà.",
				"valid_email" => "Le format de l'email est incorrect"
			]
		],
		"login" => 'required|max_length[50]',
	];

	public $userRulesRegistration = [
		"email" => [
			'rules' => 'required|valid_email|is_unique[nes_ad_users.email]',
			'errors' => [
				"is_unique" => "Un compte utilisateur ayant cette adresse email existe déjà.",
				"valid_email" => "Le format de l'email est incorrect"
			]
		],
		"login" =>  [
			"rules" => "required|is_unique[nes_ad_users.login]|max_length[50]",
			"errors" => [
				"is_unique" => "Le nom d'utilisateur existe déjà, merci d'en choisir un autre"
			]
		],
		"password" => [
			"rules" =>  "required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/]",
			"errors" => [
				"regex_match" => "Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre."
			]
		],
		"password2" => [
			"rules"   =>   "required|matches[password]",
			"errors"  => [
				"matches" => "Les mots de passe ne correspondent pas"
			]
		]
	];

}
