import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EditPersonnelPage } from './edit-personnel.page';

const routes: Routes = [
  {
    path: '',
    component: EditPersonnelPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class EditPersonnelPageRoutingModule {}
