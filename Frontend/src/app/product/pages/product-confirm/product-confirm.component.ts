import { Component, EventEmitter, Input, Output } from '@angular/core';

@Component({
  selector: 'app-product-confirm',
  templateUrl: './product-confirm.component.html',
  styleUrl: './product-confirm.component.css'
})
export class ProductConfirmComponent {
  @Input({required:true}) code!:string;
  @Output() onDelete = new EventEmitter<string>;
  @Output() onCancel = new EventEmitter;
}
