import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CreateSpecialitePage } from './create-specialite.page';

const routes: Routes = [
  {
    path: '',
    component: CreateSpecialitePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CreateSpecialitePageRoutingModule {}
