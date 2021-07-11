import { UserModel } from './../../Model/use.model';
import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  global = 'http://127.0.0.1:8000/api/';
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization ': `Bearer ${localStorage.getItem('token')}`
    })
  };

  constructor(private http: HttpClient) { }

  create(spe: UserModel){
    return this.http.post('http://127.0.0.1:8000/user/new', spe);
  }
  getUser(){
    return this.http.get(this.global + 'user/', this.httpOptions);
  }

  edit(urgence: UserModel, id: number){
    return this.http.post('http://127.0.0.1:8000/api/user/modif/edit/' + id, urgence, this.httpOptions);
  }

  getOne(id: number){
    return this.http.get(this.global + 'show/' + id, this.httpOptions);
  }
}
