import { ShowPersonnelPage } from './../show-personnel/show-personnel.page';
import { ModalController, MenuController } from '@ionic/angular';
import { PersonnelService } from './../../service/personnel.service';
import { PersonnelModel } from './../../../Model/personnel.model';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-index-personnel',
  templateUrl: './index-personnel.page.html',
  styleUrls: ['./index-personnel.page.scss'],
})
export class IndexPersonnelPage implements OnInit {

  personels: PersonnelModel;
  constructor(private perso: PersonnelService, private modalController: ModalController, private menu: MenuController) { }

  ngOnInit(): void {
    this.getPersonnel();
  }

  delete(id: number){
    this.perso.delete(id).subscribe((data: PersonnelModel) => {
      this.personels = data;
      this.getPersonnel();
    });
  }
  openFirst() {
    this.menu.enable(true, 'first');
    this.menu.open('first');
  }

  getPersonnel(){
    this.perso.getpersonnel().subscribe((data: PersonnelModel) => {
      this.personels = data;
    });
    console.log(this.personels);
  }
  async presentModal(personnes: PersonnelModel) {
    const modal = await this.modalController.create({
      component: ShowPersonnelPage,
      cssClass: 'my-custom-class',
      componentProps: {
        personne: personnes

      }
    });
    return await modal.present();
  }
}
