import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { IndexPersonnelPage } from './index-personnel.page';

describe('IndexPersonnelPage', () => {
  let component: IndexPersonnelPage;
  let fixture: ComponentFixture<IndexPersonnelPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IndexPersonnelPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(IndexPersonnelPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
