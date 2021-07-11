import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { EditPersonnelPage } from './edit-personnel.page';

describe('EditPersonnelPage', () => {
  let component: EditPersonnelPage;
  let fixture: ComponentFixture<EditPersonnelPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditPersonnelPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(EditPersonnelPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
