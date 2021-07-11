import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CreateSpecialitePage } from './create-specialite.page';

describe('CreateSpecialitePage', () => {
  let component: CreateSpecialitePage;
  let fixture: ComponentFixture<CreateSpecialitePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreateSpecialitePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CreateSpecialitePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
