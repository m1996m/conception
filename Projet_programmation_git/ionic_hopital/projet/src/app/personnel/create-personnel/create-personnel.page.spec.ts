import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CreatePersonnelPage } from './create-personnel.page';

describe('CreatePersonnelPage', () => {
  let component: CreatePersonnelPage;
  let fixture: ComponentFixture<CreatePersonnelPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreatePersonnelPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CreatePersonnelPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
