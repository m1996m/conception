import { SpecialiteService } from './../../service/specialite.service';
import { ActivatedRoute, Router } from '@angular/router';
import { SpecialModel } from './../specialite.model';
import { PersonnelModel } from './../../../Model/personnel.model';
import { FormGroup, FormBuilder } from '@angular/forms';
import { Component, OnInit } from '@angular/core';
import { PersonnelService } from 'src/app/service/personnel.service';

@Component({
  selector: 'app-edit-personnel',
  templateUrl: './edit-personnel.page.html',
  styleUrls: ['./edit-personnel.page.scss'],
})
export class EditPersonnelPage implements OnInit {

  form: FormGroup;
  id: number;
  personnel: PersonnelModel = new PersonnelModel('','','','','','',0,'','','');
  specials: SpecialModel;
  constructor(private fb: FormBuilder, private perso: PersonnelService,
     private router: ActivatedRoute, private route: Router, private spe: SpecialiteService) { }

  ngOnInit(): void {
    this.intitForm();
    this.id = this.router.snapshot.params['id'];
    this.perso.getOne(this.id).subscribe((data: PersonnelModel) => {
      this.personnel= data;
    });
    this.spe.getSpe().subscribe((data: SpecialModel) => {
      this.specials = data;
      console.log(this.specials);
      this.intitForm();
    });
  }

  intitForm(){
    this.form = this.fb.group({
      nom:[this.personnel.nom],
      prenom:[this.personnel.prenom],
      dateNaissance:[this.personnel.dateNaissance],
      adresse:[this.personnel.adresse],
      telephone:[this.personnel.telephone],
      image:[this.personnel.image],
      genre:[this.personnel.genre],
      profession:[this.personnel.profession],
      fonction:[this.personnel.fonction],
      specilite:[this.personnel.specialite]
    });
  }
  Enregistrer(){
    this.perso.edit(this.form.value, this.id).subscribe((data: PersonnelModel) => {
      this.personnel = data;
      this.route.navigate(['/indexPersonnel']);
    });
  }

}
