import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ShowPersonnelPage } from './show-personnel.page';

describe('ShowPersonnelPage', () => {
  let component: ShowPersonnelPage;
  let fixture: ComponentFixture<ShowPersonnelPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowPersonnelPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ShowPersonnelPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
