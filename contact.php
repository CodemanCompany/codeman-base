<?php
//  ██████╗ ██████╗ ██████╗ ███████╗███╗   ███╗ █████╗ ███╗   ██╗
// ██╔════╝██╔═══██╗██╔══██╗██╔════╝████╗ ████║██╔══██╗████╗  ██║
// ██║     ██║   ██║██║  ██║█████╗  ██╔████╔██║███████║██╔██╗ ██║
// ██║     ██║   ██║██║  ██║██╔══╝  ██║╚██╔╝██║██╔══██║██║╚██╗██║
// ╚██████╗╚██████╔╝██████╔╝███████╗██║ ╚═╝ ██║██║  ██║██║ ╚████║
//  ╚═════╝ ╚═════╝ ╚═════╝ ╚══════╝╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝

namespace Codeman;
use Exception;

// Interface
interface Codeman {
	public function validate_request();
	// public function show();
}	// end interface

// Traits
// trait Validations {
// 	private function assign( $var ) {
// 		return ( isset( $this -> input -> $var ) ) ? $this -> input -> $var : null;
// 	}	// end method

// 	private function test( $pattern, $input ) {
// 		return preg_match( $pattern, mb_strtolower( $input, 'UTF-8' ) );
// 	}	// end method

// 	public function validate_email( $input = null ) {
// 		$input = ( is_null( $input ) ) ? $this -> assign( 'email' ) : $input;

// 		if( is_null( $input ) )
// 			throw new Exception( 'Null parameter.' );
// 		if( filter_var( mb_strtolower( $input, 'UTF-8' ), FILTER_VALIDATE_EMAIL ) )
// 			return true;

// 		throw new Exception( 'Wrong email' );
// 	}	// end method

// 	public function validate_message( $input = null ) {
// 		$input = ( is_null( $input ) ) ? $this -> assign( 'message' ) : $input;
		
// 		if( is_null( $input ) )
// 			throw new Exception( 'Null parameter.' );
// 		if( $this -> test( '/.{10,500}/', $input ) )
// 			return true;

// 		throw new Exception( 'Wrong message' );
// 	}	// end method

// 	public function validate_name( $input = null ) {
// 		$input = ( is_null( $input ) ) ? $this -> assign( 'name' ) : $input;
		
// 		if( is_null( $input ) )
// 			throw new Exception( 'Null parameter.' );
// 		if( $this -> test( '/^(?=.*[aeiouáàäâãåąæāéèëêęėēíïìîįīóòöôõøœōúüùûū])(?=.*[bcdfghjklmnñpqrstvwxyz])[a-zñ áàäâãåąæāéèëêęėēíïìîįīóòöôõøœōúüùûū]{3,100}$/u', $input ) )
// 			return true;

// 		throw new Exception( 'Wrong name' );
// 	}	// end method

// 	public function validate_subject( $input = null ) {
// 		$input = ( is_null( $input ) ) ? $this -> assign( 'subject' ) : $input;
		
// 		if( is_null( $input ) )
// 			throw new Exception( 'Null parameter.' );
// 		if( $this -> test( '/^(?=.*[(aeiouáàäâãåąæāéèëêęėēíïìîįīóòöôõøœōúüùûū)|(bcdfghjklmnñpqrstvwxyz)|(0-9)])[\w aeiouáàäâãåąæāéèëêęėēíïìîįīóòöôõøœōúüùûū]{3,100}$/u', $input ) )
// 			return true;

// 		throw new Exception( 'Wrong subject' );
// 	}	// end method

// 	public function validate_tel( $input = null ) {
// 		$input = ( is_null( $input ) ) ? $this -> assign( 'tel' ) : $input;
		
// 		if( is_null( $input ) )
// 			throw new Exception( 'Null parameter.' );
// 		if( $this -> test( '/^\+?(\d{1,3})?[- .]?\(?(?:\d{2,3})\)?[- .]?\d{3,4}[- .]?\d{3,4}$/', $input ) )
// 			return true;

// 		throw new Exception( 'Wrong telephone' );
// 	}	// end method
// }	// end trait

class Contact implements Codeman {
	private $params = null;

	function __construct( $params = null ) {
		header( 'Content-Type: application/json' );

		$params = null

		if( is_null( $params ) )
			throw new Exception( 'No specified parameters' );
	}	// end construct

	public function validate_request( $secret = null ) {
		if( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' )
			throw new Exception( 'Incorrect shipping method' );

		$this -> re_captcha( $secret );

		foreach( $this -> params as $value )
			if( ! isset( $this -> put[ $value ] ) )
				throw new Exception( 'Missing parameter ' . $value );

		unset( $value );
		return true;
	}	// end method
}	// end class

try {
	// $contact = new Contact( [ 'email', 'message', 'name', 'subject', 'thanks', 'delivery' ] );
	// $contact -> validate_request( '6LctLUAUAAAAAJy2VMq8F5PzVAVWhCBFqop0acY_' );
}	// end class
catch ( Exception $error ) {
	echo json_encode( [
		'code'		=>	0,
		'message'	=>	$error -> getMessage(),
		'status'	=>	'error'
	] );
}	// end catch

// header( 'Content-type: application/json; charset=utf-8' );

// use Aws\Ses\SesClient;
// require 'aws.phar';

// $output = [
// 	'message'	=>	'Bad request',
// 	'status'	=>	'error',
// ];

// if(
// 	$_SERVER[ 'REQUEST_METHOD' ] === 'POST' &&
// 	( isset( $_POST[ 'name' ] ) && ! empty( $_POST[ 'name' ] ) ) &&
// 	( isset( $_POST[ 'email' ] ) && ! empty( $_POST[ 'email' ] ) ) &&
// 	( isset( $_POST[ 'tel' ] ) && ! empty( $_POST[ 'tel' ] ) ) &&
// 	( isset( $_POST[ 'subject' ] ) && ! empty( $_POST[ 'subject' ] ) ) &&
// 	( isset( $_POST[ 'message' ] ) && ! empty( $_POST[ 'message' ] ) ) &&
// 	( isset( $_POST[ 'g-recaptcha-response' ] ) && ! empty( $_POST[ 'g-recaptcha-response' ] ) ) &&
// 	isset( $_POST[ 'privacy' ] )
// ) {
// 	$data[ 'name' ] = trim( $_POST[ 'name' ] );
// 	$data[ 'company' ] = trim( $_POST[ 'company' ] );
// 	$data[ 'tel' ] = trim( $_POST[ 'tel' ] );
// 	$data[ 'email' ] = trim( $_POST[ 'email' ] );
// 	$data[ 'message' ] = trim( $_POST[ 'message' ] );
// 	$data[ 'recaptcha' ] = trim( $_POST[ 'g-recaptcha-response' ] );

// 	$context = [
// 		'response'	=>	$data[ 'recaptcha' ],
// 		'secret'	=>	'SECRET_KEY',
// 	];

// 	$handler = curl_init( 'https://www.google.com/recaptcha/api/siteverify' );
// 	curl_setopt( $handler, CURLOPT_POST, true );
// 	curl_setopt( $handler, CURLOPT_POSTFIELDS, http_build_query( $context ) );
// 	curl_setopt( $handler, CURLOPT_SSL_VERIFYPEER, false );
// 	curl_setopt( $handler, CURLOPT_RETURNTRANSFER, true );
// 	curl_setopt( $handler, CURLOPT_HEADER, 0 );
// 	$request = curl_exec( $handler );
// 	curl_close( $handler );
// 	$request = json_decode( $request );

// 	$output = [
// 		'message'	=>	'Is robot. We take legal actions',
// 		'status'	=>	'error',
// 	];

// 	if( $request -> success ) {
// 		define( 'CONTACT', '' );

// 		$html = file_get_contents( 'delivery.html' );
// 		$html2 = file_get_contents( 'thanks.html' );


// 		$client = new SesClient( [
// 			'version'	=>	'2010-12-01',
// 			'region'	=>	'us-east-1',
// 			'credentials'	=>	[
// 				'key'		=>	'AWS_SES_KEY',
// 				'secret'	=>	'AWS_SES_SECRET'
// 			]
// 		] );
// 		//mensaje administrador
// 		$message = null;
// 		$message[ 'Source' ] = CONTACT;
// 		$message[ 'Message' ][ 'Subject' ][ 'Charset' ] = "UTF-8";
// 		$message[ 'Message' ][ 'Body' ][ 'Html' ][ 'Charset' ] = 'UTF-8';
// 		$message[ 'Destination' ][ 'ToAddresses' ] = NULL;

// 		$message[ 'Destination' ][ 'ToAddresses' ] = NULL;
// 		$message[ 'Message' ][ 'Subject' ][ 'Data' ] = 'Tienes 1 nuevo mensaje de tu sitio web';
		
// 		//mensaje usuario
// 		$message2 = null;
// 		$message2[ 'Source' ] = CONTACT;
// 		$message2[ 'Message' ][ 'Subject' ][ 'Charset' ] = "UTF-8";
// 		$message2[ 'Message' ][ 'Body' ][ 'Html' ][ 'Charset' ] = 'UTF-8';
// 		$message2[ 'Destination' ][ 'ToAddresses' ] = NULL;

// 		$message2[ 'Destination' ][ 'ToAddresses' ] = NULL;
// 		$message2[ 'Message' ][ 'Subject' ][ 'Data' ] = 'Gracias por escribirnos';

// 		try {
// 			$message[ 'Destination' ][ 'ToAddresses' ] = [ 'me@example.com' ];
// 			$find = [ '{name}', '{company}', '{email}', '{tel}', '{message}', '{year}' ];
// 			$replace = [ $data[ 'name' ], $data[ 'company' ], $data[ 'email' ], $data[ 'tel' ], $data[ 'message' ], date( 'Y' ) ];
// 			$html = str_replace( $find, $replace, $html );
// 			$message[ 'Message' ][ 'Body' ][ 'Html' ][ 'Data' ] = $html;
// 			$client -> sendEmail( $message );

// 			$message2[ 'Destination' ][ 'ToAddresses' ] = [ $data[ 'email' ] ];
// 			$message2[ 'Message' ][ 'Body' ][ 'Html' ][ 'Data' ] = $html2;
// 			$client -> sendEmail( $message2 );
// 			$output = [
// 				'message'	=>	'Message sent',
// 				'status'	=>	'success',
// 			];
// 		}	// end try

// 		catch( Exception $error ) {
// 			echo $error -> getMessage();
// 		}	// end catch
// 	}	// end if
// }	// end if

// echo json_encode( $output, JSON_PRETTY_PRINT );