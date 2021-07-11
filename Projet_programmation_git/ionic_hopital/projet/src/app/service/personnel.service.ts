import { PersonnelModel } from './../../Model/personnel.model';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PersonnelService {

  global = 'http://127.0.0.1:8000/api/personnel/';
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    })
  };
  constructor(private http: HttpClient) { }

  create(personnel: PersonnelModel){
    return this.http.post(this.global + 'new', personnel, this.httpOptions);
  }

  getpersonnel(){
    return this.http.get(this.global + '', this.httpOptions);
  }
  getOne(id: number){
    return this.http.get(this.global + 'personnel/' + id, this.httpOptions);
  }

  delete(id: number){
    return this.http.delete(this.global + 'supp/delete/' + id, this.httpOptions);
  }

  edit(personnel: PersonnelModel, id: number){
    return this.http.post(this.global + 'modif/edit/' + id, personnel, this.httpOptions);
  }
}
