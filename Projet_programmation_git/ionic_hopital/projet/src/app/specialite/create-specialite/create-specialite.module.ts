import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CreateSpecialitePageRoutingModule } from './create-specialite-routing.module';

import { CreateSpecialitePage } from './create-specialite.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CreateSpecialitePageRoutingModule
  ],
  declarations: [CreateSpecialitePage]
})
export class CreateSpecialitePageModule {}
