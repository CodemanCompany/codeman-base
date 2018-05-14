import { Injectable } from '@angular/core';

@Injectable()
export class StorageService {
	private storage: any;
	
	constructor() {
		this.storage = localStorage;
	}	// end constructor

	public saveData( index: string, object: any ): void {
		this.storage.setItem( index, JSON.stringify( object ) );
	}	// end method

	public getData( index: string ): any {
		return JSON.parse( this.storage.getItem( index ) );
	}	// end method

	public removeData( index: string ): void {
		this.storage.removeItem( index );
	}	// end method
}	// end class