// Ionic
import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { SplashScreen } from '@ionic-native/splash-screen';
import { StatusBar } from '@ionic-native/status-bar';

// Native
// import { Dialogs } from '@ionic-native/dialogs';

// Services
import { APIService } from './service/api.service';
import { StorageService } from './service/storage.service';

// Components
import { App } from './app.component';
import { Dashboard } from './dashboard.component';

// Pages
import { LoginPage } from '../pages/landing/login/login';
import { RecoveryPasswordPage } from '../pages/landing/recovery-password/recovery-password';
import { SignUpPage } from '../pages/landing/sign-up/sign-up';

import { HomePage } from '../pages/dashboard/home/home';
import { ProfilePage } from '../pages/dashboard/profile/profile';

// Pipes


@NgModule({
	declarations: [
		// Landing
		App,
		LoginPage,
		RecoveryPasswordPage,
		SignUpPage,
		// Dashboard
		Dashboard,
		HomePage,
		ProfilePage,
	],
	imports: [
		BrowserModule,
		IonicModule.forRoot( App ),
		// IonicModule.forRoot( Dashboard ),
		HttpClientModule,
	],
	bootstrap: [ IonicApp ],
	entryComponents: [
		// Landing
		App,
		LoginPage,
		RecoveryPasswordPage,
		SignUpPage,
		// Dashboard
		Dashboard,
		HomePage,
		ProfilePage,
	],
	providers: [
		StatusBar,
		SplashScreen,
		{ provide: ErrorHandler, useClass: IonicErrorHandler },
		// Native
		// Dialogs,
		// Codeman
		APIService,
		StorageService,
	]
})
export class AppModule {}