import { PersonnelService } from './../../service/personnel.service';
import { GlobalService } from './../../service/global.service';
import { Router } from '@angular/router';
import { SpecialiteService } from './../../service/specialite.service';
import { SpecialModel } from './../specialite.model';
import { FormGroup, FormBuilder } from '@angular/forms';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-create-personnel',
  templateUrl: './create-personnel.page.html',
  styleUrls: ['./create-personnel.page.scss'],
})
export class CreatePersonnelPage implements OnInit {

  form: FormGroup;
  specials: SpecialModel;
  user: any;
  img: any;

  constructor( private fb: FormBuilder, private spe: SpecialiteService, private router: Router,private perso: PersonnelService, private global: GlobalService) { }

  ngOnInit(): void {
    this.initFom();
    this.spe.getSpe().subscribe((data: SpecialModel) => {
      this.specials = data;
      console.log(this.specials);
    });
    this.user = this.global.userConnected;
  }

  initFom(){
    this.form = this.fb.group({
      nom: [''],
      prenom: [''],
      dateNaissance: [''],
      adresse: [''],
      telephone: [''],
      image: [''],
      genre: [''],
      profession: [''],
      fonction: [''],
      specialite: ['']
    });
  }
  Enregistrer(){
    this.perso.create(this.form.value).subscribe((data: any) => {
      console.log(data);
    });
    //this.router.navigate(['/indexPersonnel']);
   /// console.log(this.form.value);
  }


  onImageChange(event) {
    const reader = new FileReader();
    if (event.target.files) {
      if (event.target.files.length > 0) {
        console.log(event);
        const file = event.target.files[0];
        reader.readAsDataURL(file);
        reader.onload = (e) => {
          this.form.get('image').setValue({
            filename: file.name,
            filetype: file.type,
            extention: file.name.substr(file.name.lastIndexOf('.') + 1),
            value: (<string> reader.result).split(',')[1],
          });
          this.img = e.target.result;
          console.log(this.img);
        };
      }
    }
    console.log(this.form.get('image').value);
  }


}
