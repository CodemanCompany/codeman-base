import { Component, ViewChild } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { LoadingController, NavController, ToastController } from 'ionic-angular';
// import { Dialogs } from '@ionic-native/dialogs';
import { APIService } from '../../../app/service/api.service';

import { Dashboard } from '../../../app/dashboard.component';
import { RecoveryPasswordPage } from '../recovery-password/recovery-password';
import { SignUpPage } from '../sign-up/sign-up';

@Component( {
	selector: 'page-login',
	templateUrl: 'login.html'
} )
export class LoginPage {
	@ViewChild( 'password' ) inputPassword;
	private form: FormGroup;

	constructor(
		private apiService: APIService,
		// private dialogs: Dialogs,
		private loadingCtrl: LoadingController,
		private navCtrl: NavController,
		private toastCtrl: ToastController
	) {
		this.form = new FormGroup( {
			"email": new FormControl( '', [ Validators.email, Validators.required ] ),
			"password": new FormControl( '', [ Validators.required ] ),
		} );
	}	// end constructor

	private ionViewDidLoad(): void {
	}	// end method

	private action(): void {
		if( ! this.form.valid )
			// this.dialogs.alert( 'Completa todos los campos.', 'Atención', 'Aceptar' );
			alert( 'Completa todos los campos.' );
		else {
			const data: any = {
				"email": this.form.controls.email.value,
				"password": this.form.controls.password.value,
			};

			let loader = this.loadingCtrl.create( {
				content: 'Verificando identidad...',
			} );

			loader.present();

			// Success
			// =============================================================================
			loader.dismiss();
			let toast = this.toastCtrl.create( {
				"duration": 1500,
				"message": "Bienvenido(a)",
				"position": "top",
			} );
			toast.present();
			this.navCtrl.setRoot( Dashboard );
			// =============================================================================

			// Error
			// =============================================================================
			// loader.dismiss();
			// this.form.setValue( {
			// 	"email": data.email,
			// 	"password": '',
			// } );

			// setTimeout( () => {
			// 	this.inputPassword.setFocus();
			// }, 1000 );

			// this.dialogs.alert( 'Datos de acceso incorrectos.', 'Error', 'Aceptar' );
			// =============================================================================
		}	// end else
	}	// end method

	private recoveryPassword( event ): void {
		event.preventDefault();
		this.navCtrl.push( RecoveryPasswordPage );
	}	// end method

	private signUp( event ): void {
		event.preventDefault();
		this.navCtrl.push( SignUpPage );
	}	// end method
}	// enc class