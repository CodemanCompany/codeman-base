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
import { RecoveryPasswordPage } from '../pages/app/recovery-password/recovery-password';
import { HomePage } from '../pages/dashboard/home/home';
import { ProfilePage } from '../pages/dashboard/profile/profile';

// Pipes


@NgModule({
	declarations: [
		// App
		App,
		LoginPage,
		RecoveryPasswordPage,
		// Dashboard
		Dashboard,
		HomePage,
		ProfilePage,
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
		RecoveryPasswordPage,
		// Dashboard
		Dashboard,
		HomePage,
		ProfilePage,
	],
	providers: [
		StatusBar,
		SplashScreen,
		{ provide: ErrorHandler, useClass: IonicErrorHandler },
	]
})
export class AppModule {}