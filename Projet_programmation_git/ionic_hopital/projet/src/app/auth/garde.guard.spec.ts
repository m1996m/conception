import { TestBed } from '@angular/core/testing';

import { GardeGuard } from './garde.guard';

describe('GardeGuard', () => {
  let guard: GardeGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(GardeGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
