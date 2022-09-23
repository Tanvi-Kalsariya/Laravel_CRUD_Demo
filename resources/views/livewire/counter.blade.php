<div class="container">
    <div class="row">
        <div class="col-6">
            <button wire:click="increment" class="btn btn-block btn-primary">+</button>
        </div>
        <div class="col-6">
            <button wire:click="decrement" class="btn btn-block btn-danger">-</button>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-12 text-center">
            <p class="btn ">
                <span class="badge badge-primary">{{ $count }} </span>
            </p>
        </div>
    </div>
</div>