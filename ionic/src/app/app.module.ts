// Ionic
import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { SplashScreen } from '@ionic-native/splash-screen';
import { StatusBar } from '@ionic-native/status-bar';

// Native
// import { Dialogs } from '@ionic-native/dialogs';

// Services


// Components
import { App } from './app.component';
import { Dashboard } from './dashboard.component';

// Pages
import { LoginPage } from '../pages/app/login/login';
import { HomePage } from '../pages/dashboard/home/home';

// Pipes


@NgModule({
	declarations: [
		// App
		App,
		LoginPage,
		// Dashboard
		Dashboard,
		HomePage,
	],
	imports: [
		BrowserModule,
		IonicModule.forRoot( App ),
		// IonicModule.forRoot( Dashboard ),
	],
	bootstrap: [ IonicApp ],
	entryComponents: [
		// App
		App,
		LoginPage,
		// Dashboard
		Dashboard,
		HomePage,
	],
	providers: [
		StatusBar,
		SplashScreen,
		{ provide: ErrorHandler, useClass: IonicErrorHandler },
	]
})
export class AppModule {}