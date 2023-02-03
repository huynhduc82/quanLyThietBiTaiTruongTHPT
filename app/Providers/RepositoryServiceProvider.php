<?php

namespace App\Providers;

use App\Repositories\Eloquents\SpecifyTheNumberOfEquipments;
use App\Repositories\Eloquents\Courses;
use App\Repositories\Eloquents\EquipmentStatus;
use App\Repositories\Eloquents\Equipment;
use App\Repositories\Eloquents\ImageInfos;
use App\Repositories\Eloquents\Rooms;
use App\Repositories\Eloquents\LendReturnEquipment;
use App\Repositories\Eloquents\Reservations;
use App\Repositories\Eloquents\User;
use App\Repositories\Eloquents\Classes;
use App\Repositories\Eloquents\Grades;
use App\Repositories\Eloquents\Maintenance;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\Grades as IGrade;
use App\Repositories\Contracts\Maintenance as IMaintenance;
use App\Repositories\Contracts\SpecifyTheNumberOfEquipments as ISpecifyTheNumberOfEquipments;
use App\Repositories\Contracts\User as IUser;
use App\Repositories\Contracts\Classes as IClasses;
use App\Repositories\Contracts\Courses as ICourse;
use App\Repositories\Contracts\Equipment As IEquipment;
use App\Repositories\Contracts\ImageInfos As IImageInfo;
use App\Repositories\Contracts\EquipmentStatus As IEquipmentStatus;
use App\Repositories\Contracts\Rooms As IRooms;
use App\Repositories\Contracts\LendReturnEquipment As ILendReturnEquipment;
use App\Repositories\Contracts\Reservations As IReservations;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons;

    public function register(): void
    {
        $this->singletons = self::$repos;
    }

    public static array $repos = [
        /*
         * ------------------------------------------------------------
         * Equipment
         * ------------------------------------------------------------
         */
        IEquipment\IEquipmentRepo::class => Equipment\EquipmentRepo::class,
        IEquipment\ITypeOfEquipmentRepo::class => Equipment\TypeOfEquipmentRepo::class,
        /*
         * ------------------------------------------------------------
         * Image Info
         * ------------------------------------------------------------
         */
        IImageInfo\IImageInfoRepo::class => ImageInfos\ImageInfoRepo::class,
        /*
         * ------------------------------------------------------------
         * Equipment Status
         * ------------------------------------------------------------
         */
        IEquipmentStatus\IEquipmentStatusRepo::class => EquipmentStatus\EquipmentStatusRepo::class,
        /*
         * ------------------------------------------------------------
         * Rooms
         * ------------------------------------------------------------
         */
        IRooms\IRoomRepo::class => Rooms\RoomRepo::class,
        /*
         * ------------------------------------------------------------
         * Lend Return Equipment
         * ------------------------------------------------------------
         */
        ILendReturnEquipment\ILendReturnEquipmentRepo::class => LendReturnEquipment\LendReturnEquipmentRepo::class,
        ILendReturnEquipment\ILendReturnEquipmentDetailsRepo::class => LendReturnEquipment\LendReturnEquipmentDetailsRepo::class,
        /*
         * ------------------------------------------------------------
         * Reservation Equipment
         * ------------------------------------------------------------
         */
        IReservations\IEquipmentReservationRepo::class => Reservations\EquipmentReservationRepo::class,
        IReservations\IEquipmentReservationDetailRepo::class => Reservations\EquipmentReservationDetailRepo::class,
        /*
         * ------------------------------------------------------------
         * Course
         * ------------------------------------------------------------
         */
        ICourse\ICourseRepo::class => Courses\CourseRepo::class,
        ICourse\ICourseDetailRepo::class => Courses\CourseDetailsRepo::class,
        /*
         * ------------------------------------------------------------
         * User
         * ------------------------------------------------------------
         */
        IUser\IUserProfileRepo::class => User\UserProfileRepo::class,
        /*
         * ------------------------------------------------------------
         * Specify The Number Of Equipments
         * ------------------------------------------------------------
         */
        ISpecifyTheNumberOfEquipments\ISpecifyTheNumberOfEquipmentsRepo::class => SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsRepo::class,
        /*
         * ------------------------------------------------------------
         * Specify The Number Of Equipments
         * ------------------------------------------------------------
         */
        IClasses\IClassRepo::class => Classes\ClassRepo::class,
        IClasses\IClassTimeRegulationRepo::class => Classes\ClassTimeRegulationRepo::class,
        /*
         * ------------------------------------------------------------
         * Grades
         * ------------------------------------------------------------
         */
        IGrade\IGradeRepo::class => Grades\GradeRepo::class,
        /*
         * ------------------------------------------------------------
         * Maintenance
         * ------------------------------------------------------------
         */
        IMaintenance\IMaintenanceRepo::class => Maintenance\MaintenanceRepo::class,
        IMaintenance\IMaintenanceDetailsRepo::class => Maintenance\MaintenanceDetailsRepo::class,
    ];
}
