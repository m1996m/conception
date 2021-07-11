import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CreatePersonnelPageRoutingModule } from './create-personnel-routing.module';

import { CreatePersonnelPage } from './create-personnel.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CreatePersonnelPageRoutingModule,
    ReactiveFormsModule,
  ],
  declarations: [CreatePersonnelPage]
})
export class CreatePersonnelPageModule {}
