import { ActivatedRoute } from '@angular/router';
import { PersonnelService } from './../../service/personnel.service';
import { PersonnelModel } from './../../../Model/personnel.model';
import { ModalController, LoadingController } from '@ionic/angular';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-show-personnel',
  templateUrl: './show-personnel.page.html',
  styleUrls: ['./show-personnel.page.scss'],
})
export class ShowPersonnelPage implements OnInit {

  @Input() personne: PersonnelModel;
  id: number;
  personnel: PersonnelModel;
  personels: PersonnelModel;
  constructor(private perso: PersonnelService, private router: ActivatedRoute) { }

  ngOnInit(): void {
  }
  delete(id: number){
    console.log(id);
    this.perso.delete(id).subscribe((data: any) => {
      this.personels = data;
      console.log(data);
    });
  }


}
