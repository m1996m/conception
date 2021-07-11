import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class GlobalService {
  userConnected: any;
  isAuth = false;
  global = 'http://127.0.0.1:8000/api/';
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization ': `Bearer ${localStorage.getItem('token')}`
    })
  };

  constructor(private http: HttpClient) { }
  getUser(){
    return this.http.get(this.global + 'user/', this.httpOptions);
  }
}
