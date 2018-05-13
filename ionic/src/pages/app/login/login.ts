import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
// import { Dialogs } from '@ionic-native/dialogs';
// import { APIService } from '../../app/service/api.service';

import { Dashboard } from '../../../app/dashboard.component';

@Component( {
	selector: 'page-login',
	templateUrl: 'login.html'
} )
export class LoginPage {
	constructor(
		// private apiService: APIService,
		// private dialogs: Dialogs,
		private navCtrl: NavController
	) {}	// end constructor

	private ionViewDidLoad(): void {
	}	// end method

	private action(): void {
		this.navCtrl.setRoot( Dashboard );
	}	// end method
}	// enc class