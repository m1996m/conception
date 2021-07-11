import { UserModel } from './../../../Model/use.model';
import { UserService } from './../../service/user.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-create-user',
  templateUrl: './create-user.page.html',
  styleUrls: ['./create-user.page.scss'],
})
export class CreateUserPage implements OnInit {

  form: FormGroup;
  user: UserModel;

  constructor(private fb: FormBuilder, private userservice: UserService, private route: Router) { }

  ngOnInit(): void {
    this.initForm();
  }
  initForm(){
    this.form = this.fb.group({
      userName: [''],
      email:  [''],
      password: [''],
      confirmation: ['']
    });
  }
  Enregistrer(){
    console.log('malick');
    this.userservice.create(this.form.value).subscribe((data: any) => {
      console.log(data);
      this.route.navigate(['/login']);

    });
  }

}
