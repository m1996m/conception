import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { EditPersonnelPageRoutingModule } from './edit-personnel-routing.module';

import { EditPersonnelPage } from './edit-personnel.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    EditPersonnelPageRoutingModule,
    ReactiveFormsModule
  ],
  declarations: [EditPersonnelPage]
})
export class EditPersonnelPageModule {}
