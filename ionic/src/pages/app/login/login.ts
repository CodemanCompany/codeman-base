import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
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
	constructor(
		private apiService: APIService,
		// private dialogs: Dialogs,
		private navCtrl: NavController
	) {}	// end constructor

	private ionViewDidLoad(): void {
	}	// end method

	private action(): void {
		this.navCtrl.setRoot( Dashboard );
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