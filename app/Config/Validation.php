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

	public $signup = [
		'email' => 'required|valid_email|is_unique[user.email]',
		'first_name' => 'required',
		'last_name' => 'required',
		'password' => 'required',
		'passwordConf' => 'required|matches[password]'
	];

	public $signup_errors = [
		'email' => [
			'required' => 'Email is required',
			'valid_email' => 'Provided email is not valid',
			'is_unique' => 'An account already exists with that email'
		],
		'first_name' => [
			'required' => 'First Name is required',
		],
		'last_name' => [
			'required' => 'Last Name is required',
		],
		'password' => [
			'required' => 'Password is required',
		],
		'passwordConf' => [
			'required' => 'Password confirmation is required',
			'matches' => 'Password confirmation must match password'
		]
	];

	public $login = [
		'email' => 'required|valid_email',
		'password' => 'required'
	];

	public $login_errors = [
		'email' => [
			'required' => 'Email is required',
			'valid_email' => 'Provided email is not valid'
		],
		'password' => [
			'required' => 'Password is required',
		]
	];
}
