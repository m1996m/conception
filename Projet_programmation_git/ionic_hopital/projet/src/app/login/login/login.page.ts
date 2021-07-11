import { AuthService } from './../../service/auth.service';
import { GlobalService } from './../../service/global.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  form: FormGroup;
  isAuth: boolean;
  user: any;
  constructor(private fb: FormBuilder, private authServie: AuthService, private global: GlobalService, private router: Router) { }
  ngOnInit(): void {
    this.form = this.fb.group({
      username: [''],
      password: ['']
    });
  }
  loginUser()  {
    this.authServie.loginUser(this.form.value).subscribe((res: any) => {
     console.log(res.token);
     this.isAuth = true;
     localStorage.setItem('token', res.token);
     this.authServie.getUser(res.token).subscribe((res1: any) => {
      console.log(res1);
      this.global.userConnected = res1['user '];
      this.global.isAuth = true;
      this.router.navigate(['/index-personnel']);
    });
   }, (error) => {
    this.isAuth = false;
    console.log(this.isAuth);
   });

  }

}
