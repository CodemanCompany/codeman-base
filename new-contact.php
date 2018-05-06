<?php
// TODO: Valide and POO

header( 'Content-type: application/json; charset=utf-8' );

use Aws\Ses\SesClient;
require 'aws.phar';

$output = [
	'message'	=>	'Bad request',
	'status'	=>	'error',
];

if(
	$_SERVER[ 'REQUEST_METHOD' ] === 'POST' &&
	( isset( $_POST[ 'name' ] ) && ! empty( $_POST[ 'name' ] ) ) &&
	( isset( $_POST[ 'email' ] ) && ! empty( $_POST[ 'email' ] ) ) &&
	( isset( $_POST[ 'tel' ] ) && ! empty( $_POST[ 'tel' ] ) ) &&
	( isset( $_POST[ 'subject' ] ) && ! empty( $_POST[ 'subject' ] ) ) &&
	( isset( $_POST[ 'message' ] ) && ! empty( $_POST[ 'message' ] ) ) &&
	( isset( $_POST[ 'g-recaptcha-response' ] ) && ! empty( $_POST[ 'g-recaptcha-response' ] ) ) &&
	isset( $_POST[ 'privacy' ] )
) {
	$data = [];
	$data[ 'name' ] = trim( $_POST[ 'name' ] );
	$data[ 'company' ] = trim( $_POST[ 'company' ] );
	$data[ 'tel' ] = trim( $_POST[ 'tel' ] );
	$data[ 'email' ] = trim( $_POST[ 'email' ] );
	$data[ 'message' ] = trim( $_POST[ 'message' ] );
	$data[ 'recaptcha' ] = trim( $_POST[ 'g-recaptcha-response' ] );

	$context = [
		'response'	=>	$data[ 'recaptcha' ],
		'secret'	=>	'SECRET_KEY',
	];

	$handler = curl_init( 'https://www.google.com/recaptcha/api/siteverify' );
	curl_setopt( $handler, CURLOPT_POST, true );
	curl_setopt( $handler, CURLOPT_POSTFIELDS, http_build_query( $context ) );
	curl_setopt( $handler, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $handler, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $handler, CURLOPT_HEADER, 0 );
	$request = curl_exec( $handler );
	curl_close( $handler );
	$request = json_decode( $request );

	$output = [
		'message'	=>	'Is robot. We take legal actions',
		'status'	=>	'error',
	];

	if( $request -> success ) {
		define( 'CONTACT', '' );

		$html = file_get_contents( 'delivery.html' );
		$html2 = file_get_contents( 'thanks.html' );


		$client = new SesClient( [
			'version'	=>	'2010-12-01',
			'region'	=>	'us-east-1',
			'credentials'	=>	[
				'key'		=>	'AWS_SES_KEY',
				'secret'	=>	'AWS_SES_SECRET'
			]
		] );
		//mensaje administrador
		$message = null;
		$message[ 'Source' ] = CONTACT;
		$message[ 'Message' ][ 'Subject' ][ 'Charset' ] = "UTF-8";
		$message[ 'Message' ][ 'Body' ][ 'Html' ][ 'Charset' ] = 'UTF-8';
		$message[ 'Destination' ][ 'ToAddresses' ] = NULL;

		$message[ 'Destination' ][ 'ToAddresses' ] = NULL;
		$message[ 'Message' ][ 'Subject' ][ 'Data' ] = 'Tienes 1 nuevo mensaje de tu sitio web';
		
		//mensaje usuario
		$message2 = null;
		$message2[ 'Source' ] = CONTACT;
		$message2[ 'Message' ][ 'Subject' ][ 'Charset' ] = "UTF-8";
		$message2[ 'Message' ][ 'Body' ][ 'Html' ][ 'Charset' ] = 'UTF-8';
		$message2[ 'Destination' ][ 'ToAddresses' ] = NULL;

		$message2[ 'Destination' ][ 'ToAddresses' ] = NULL;
		$message2[ 'Message' ][ 'Subject' ][ 'Data' ] = 'Gracias por escribirnos';

		try {
			$message[ 'Destination' ][ 'ToAddresses' ] = [ 'me@example.com' ];
			$find = [ '{name}', '{company}', '{email}', '{tel}', '{message}', '{year}' ];
			$replace = [ $data[ 'name' ], $data[ 'company' ], $data[ 'email' ], $data[ 'tel' ], $data[ 'message' ], date( 'Y' ) ];
			$html = str_replace( $find, $replace, $html );
			$message[ 'Message' ][ 'Body' ][ 'Html' ][ 'Data' ] = $html;
			$client -> sendEmail( $message );

			$message2[ 'Destination' ][ 'ToAddresses' ] = [ $data[ 'email' ] ];
			$message2[ 'Message' ][ 'Body' ][ 'Html' ][ 'Data' ] = $html2;
			$client -> sendEmail( $message2 );
			$output = [
				'message'	=>	'Message sent',
				'status'	=>	'success',
			];
		}	// end try

		catch( Exception $error ) {
			echo $error -> getMessage();
		}	// end catch
	}	// end if
}	// end if

echo json_encode( $output, JSON_PRETTY_PRINT );