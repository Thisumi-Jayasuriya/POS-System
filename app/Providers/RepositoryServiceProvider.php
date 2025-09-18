<?php

namespace App\Providers;

use App\Repositories\All\Attendance\AttendanceRepository;
use App\Repositories\All\Attendance\AttendanceRepositoryInterface;
use App\Repositories\All\Member\MemberRepository;
use App\Repositories\All\Member\MemberRepositoryInterface;
use App\Repositories\All\Membership\MembershipRepository;
use App\Repositories\All\Membership\MembershipRepositoryInterface;
use App\Repositories\All\Role\RolesRepository;
use App\Repositories\All\Role\RolesRepositoryInterface;
use App\Repositories\All\Staff\StaffRepository;
use App\Repositories\All\Staff\StaffRepositoryInterface;
use App\Repositories\All\Trainer\TrainerRepository;
use App\Repositories\All\Trainer\TrainerRepositoryInterface;
use App\Repositories\All\Access\AccessDoorRepository;
use App\Repositories\All\Access\AccessDoorRepositoryInterface;
use App\Repositories\All\Access\AccessUserAccessRepository;
use App\Repositories\All\Access\AccessUserAccessRepositoryInterface;
use App\Repositories\All\Bookings\BookingRepository;
use App\Repositories\All\Bookings\BookingRepositoryInterface;
use App\Repositories\All\Bookings\SportGroundBookingRepository;
use App\Repositories\All\Bookings\SportGroundBookingRepositoryInterface;
use App\Repositories\All\Bookings\SportRepositoryInterface;
use App\Repositories\All\Bookings\TournamentBookingRepository;
use App\Repositories\All\Bookings\TournamentBookingRepositoryInterface;
use App\Repositories\All\Inquiries\InquiriesRepository;
use App\Repositories\All\Inquiries\InquiriesRepositoryInterface;
use App\Repositories\All\payment\PaymentRepository;
use App\Repositories\All\payment\PaymentRepositoryInterface;
use App\Repositories\All\payment\PaymentSettingRepository;
use App\Repositories\All\payment\PaymentSettingRepositoryInterface;
use App\Repositories\All\Schedules\CustomScheduleRepository;
use App\Repositories\All\Schedules\CustomScheduleRepositoryInterface;
use App\Repositories\All\Schedules\PremadeSchedulesRepository;
use App\Repositories\All\Schedules\PremadeSchedulesRepositoryInterface;
use App\Repositories\All\Schedules\SchedulesRepository;
use App\Repositories\All\Schedules\SchedulesRepositoryInterface;
use App\Repositories\All\User\UserRepository;
use App\Repositories\All\User\UserRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->bind(TrainerRepositoryInterface::class, TrainerRepository::class);
        $this->app->bind(MembershipRepositoryInterface::class, MembershipRepository::class);
        $this->app->bind(InquiriesRepositoryInterface::class, InquiriesRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(SportGroundBookingRepositoryInterface::class, SportGroundBookingRepository::class);
        $this->app->bind(TournamentBookingRepositoryInterface::class, TournamentBookingRepository::class);
        $this->app->bind(SportRepositoryInterface::class, SportRepositoryInterface::class);
        $this->app->bind(SchedulesRepositoryInterface::class, SchedulesRepository::class);
        $this->app->bind(PremadeSchedulesRepositoryInterface::class, PremadeSchedulesRepository::class);
        $this->app->bind(CustomScheduleRepositoryInterface::class, CustomScheduleRepository::class);
        $this->app->bind(AccessDoorRepositoryInterface::class, AccessDoorRepository::class);
        $this->app->bind(AccessUserAccessRepositoryInterface::class, AccessUserAccessRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(PaymentSettingRepositoryInterface::class, PaymentSettingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
