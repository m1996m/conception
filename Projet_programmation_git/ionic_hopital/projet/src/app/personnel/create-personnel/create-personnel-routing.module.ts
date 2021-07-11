import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CreatePersonnelPage } from './create-personnel.page';

const routes: Routes = [
  {
    path: '',
    component: CreatePersonnelPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CreatePersonnelPageRoutingModule {}
