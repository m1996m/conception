import { SpecialModel } from './../personnel/specialite.model';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SpecialiteService {

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json',
      'Authorization': 'my-auth-token'
    })

  }

  constructor(private http: HttpClient) { }

  create(spe: SpecialModel){
    return this.http.post('http://127.0.0.1:8000/specialite/new', spe);
  }
  getSpe(){
   return this.http.get('http://127.0.0.1:8000/specialite/');
  }
}
