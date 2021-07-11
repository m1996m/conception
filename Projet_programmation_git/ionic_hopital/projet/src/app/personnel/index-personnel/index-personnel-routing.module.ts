import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { IndexPersonnelPage } from './index-personnel.page';

const routes: Routes = [
  {
    path: '',
    component: IndexPersonnelPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class IndexPersonnelPageRoutingModule {}
