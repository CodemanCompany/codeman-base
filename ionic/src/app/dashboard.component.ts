import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

// Components
import { App } from './app.component';

// Pages
import { HomePage } from '../pages/dashboard/home/home';

interface Page {
	title: string,
	component: any
}	// end interface

@Component( {
	templateUrl: 'dashboard.html'
} )
export class Dashboard {
	@ViewChild( Nav ) nav: Nav;
	rootPage: any = HomePage;
	pages: Page[];

	constructor(
		platform: Platform,
		splashScreen: SplashScreen,
		statusBar: StatusBar
	) {
		this.pages = [
			{ title: 'Inicio', component: HomePage },
		];

		platform.ready().then( () => {
			// Okay, so the platform is ready and our plugins are available.
			// Here you can do any higher level native things you might need.
			statusBar.styleDefault();
			splashScreen.hide();
		} );
	}	// end constructor

	private openPage( page ) {
		// Reset the content nav to have just this page
		// we wouldn't want the back button to show in this scenario
		this.nav.setRoot( page.component );
	}	// end method

	private exit() {
		localStorage.clear();
		this.nav.setRoot( App );
	}	// end method
}	// end class