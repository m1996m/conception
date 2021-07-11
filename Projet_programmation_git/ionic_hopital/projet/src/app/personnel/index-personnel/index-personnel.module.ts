import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { IndexPersonnelPageRoutingModule } from './index-personnel-routing.module';

import { IndexPersonnelPage } from './index-personnel.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    IndexPersonnelPageRoutingModule
  ],
  declarations: [IndexPersonnelPage]
})
export class IndexPersonnelPageModule {}
