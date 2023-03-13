<div class="col-md-3">
    <div class="d-flex flex-column">
        <div class="card p-3 mb-3">
            <h3 class="card-title">New Users</h3>
            <p class="card-text">You have <?= $new_user ?> new users today.</p>
        </div>
        <div class="card p-3 mb-3">
            <h3 class="card-title">New Orders</h3>
            <p class="card-text">You have <?= $new_order ?> new orders.</p>
        </div>
        <div class="card p-3 mb-3">
            <h3 class="card-title">Confirmed Orders</h3>
            <p class="card-text">You confirmed <?= $confirmed_new_order ?> orders.</p>
        </div>
        <div class="card p-3 mb-3">
            <h3 class="card-title">Revenue</h3>
            <p class="card-text">You made today $<?= $money_made ?> from confirmed orders.</p>
        </div>
    </div>
</div>