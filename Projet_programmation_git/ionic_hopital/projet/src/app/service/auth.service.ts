import { GlobalService } from './global.service';
import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  sLoggedIn = false;

  // store the URL so we can redirect after logging in
  redirectUrl: string;
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    })
  };
  constructor(private http: HttpClient, private global: GlobalService) { }

  loginUser(data: any){
    return this.http.post('http://localhost:8000/api/login_check', data);
  }
  getUser(token: any) {
    return this.http.get('http://localhost:8000/api/user_connected', {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      })
    });
  }

}
