<?php

declare(strict_types=1);

namespace App\DTOs\Training;

use App\Enums\ModelStatus;
use App\Enums\ModelType;
use App\Models\MlModel;
use Carbon\Carbon;

final readonly class TrainingData
{
    public function __construct(
        public string $uuid,

        public string $modelName,

        public string $modelVersion,

        public ModelType $modelType,

        public ModelStatus $status,

        public ?Carbon $trainedFrom,

        public ?Carbon $trainedUntil,

        public int $datasetSize,

        public float $trainingTime,

        public string $modelHash,

        public string $modelPath,

        public ?string $scalerPath,

        public ?string $description,
    ) {
    }

    /**
     * Create DTO from model.
     */
    public static function fromModel(
        MlModel $model,
    ): self {

        return new self(

            uuid: $model->uuid,

            modelName: $model->model_name,

            modelVersion: $model->model_version,

            modelType: $model->model_type,

            status: $model->status,

            trainedFrom: $model->trained_from,

            trainedUntil: $model->trained_until,

            datasetSize: $model->dataset_size,

            trainingTime: $model->training_time,

            modelHash: $model->model_hash,

            modelPath: $model->model_path,

            scalerPath: $model->scaler_path,

            description: $model->description,
        );
    }
}