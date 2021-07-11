import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ShowPersonnelPage } from './show-personnel.page';

const routes: Routes = [
  {
    path: '',
    component: ShowPersonnelPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ShowPersonnelPageRoutingModule {}
