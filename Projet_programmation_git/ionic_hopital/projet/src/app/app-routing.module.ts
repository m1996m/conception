import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'folder/Inbox',
    pathMatch: 'full'
  },
  {
    path: 'folder/:id',
    loadChildren: () => import('./folder/folder.module').then( m => m.FolderPageModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./login/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'create-user',
    loadChildren: () => import('./use/create-user/create-user.module').then( m => m.CreateUserPageModule)
  },
  {
    path: 'create-personnel',
    loadChildren: () => import('./personnel/create-personnel/create-personnel.module').then( m => m.CreatePersonnelPageModule)
  },
  {
    path: 'index-personnel',
    loadChildren: () => import('./personnel/index-personnel/index-personnel.module').then( m => m.IndexPersonnelPageModule)
  },
  {
    path: 'edit-personnel/:id',
    loadChildren: () => import('./personnel/edit-personnel/edit-personnel.module').then( m => m.EditPersonnelPageModule)
  },
  {
    path: 'show-personnel',
    loadChildren: () => import('./personnel/show-personnel/show-personnel.module').then( m => m.ShowPersonnelPageModule)
  },
  {
    path: 'create-specialite',
    loadChildren: () => import('./specialite/create-specialite/create-specialite.module').then( m => m.CreateSpecialitePageModule)
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
