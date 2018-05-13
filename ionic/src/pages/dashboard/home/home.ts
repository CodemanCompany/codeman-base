import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
// import { Dialogs } from '@ionic-native/dialogs';
// import { APIService } from '../../app/service/api.service';

@Component( {
	selector: 'page-home',
	templateUrl: 'home.html'
} )
export class HomePage {
	constructor(
		// private apiService: APIService,
		// private dialogs: Dialogs,
		private navCtrl: NavController
	) {}	// end constructor

	private ionViewDidLoad(): void {
	}	// end method

	private action(): void {
	}	// end method
}	// enc class