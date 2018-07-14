import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import 'rxjs/add/operator/map';
import { StorageService } from './storage.service';

@Injectable()
export class APIService {
	private url: string = '';
	private token: string = "CODEMAN_TOKEN";
	
	constructor(
		private httpClient: HttpClient,
		public storageService: StorageService,
	) {


	}	// end constructor

	private formData( data: any = {} ): any {
		let httpParams: HttpParams = new HttpParams();

		for( let index in data ) {
			if( Array.isArray( data[ index ] ) ) {
				for( let item of data[ index ] ) {
					httpParams = httpParams.append( String( index ) + '[]', item );
				}	// end for
			}	// end if
			else {
				httpParams = httpParams.append( index, data[ index ] );
			}	// end else
		}	// end for

		return httpParams;
	}	// end method

	private getHeaders( isGET: boolean = false ): HttpHeaders {
		
		this.getToken();

		return new HttpHeaders( {
			"Content-Type": isGET ? "x-www-form-urlencoded" : "application/json",
			"Authorization": "Bearer " + this.token
		} );
	}	// end method

	public check( response: any ) {
		return response.status && response.status === 'success';
	}	// end method

	public delete( endpoint: string, data: any = {} ): any {
		return this.httpClient.delete( this.url + endpoint );
	}	// end method

	public get( endpoint: string, data: any = {} ): any {
		let headers = this.getHeaders( true );
		let params = this.formData( data );
		return this.httpClient.get( this.url + endpoint, { headers, params } );
	}	// end method

	public getToken(): string  {
		this.token = this.storageService.getData( 'token' ) || '';
		return this.token;
	}	// end method

	public post( endpoint: string, data: any = {} ): any {
		let headers = this.getHeaders();
		return this.httpClient.post( this.url + endpoint, data, { headers } );
	}	// end method

	public put( endpoint: string, data: any = {} ): any {
		let headers = this.getHeaders();
		return this.httpClient.put( this.url + endpoint, data, { headers } );
	}	// end method

	public setToken( token: string ) {
		this.token = token;
		this.storageService.saveData( "token", token );
	}	// end method

}	// end class