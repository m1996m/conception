import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ShowPersonnelPageRoutingModule } from './show-personnel-routing.module';

import { ShowPersonnelPage } from './show-personnel.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ShowPersonnelPageRoutingModule
  ],
  declarations: [ShowPersonnelPage]
})
export class ShowPersonnelPageModule {}
